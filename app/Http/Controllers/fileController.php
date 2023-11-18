<?php

namespace App\Http\Controllers;

use App\Models\colorsModel;
use App\Models\fileModel;
use App\Models\StoreModel;
use App\Models\SizesModel;
use App\Models\SalesStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\AssignOp\Concat;

class fileController extends Controller
{   

    public function searchArticle(Request $request)
    {
        $selectedSku = $request->input('selected_sku');
        $selectedColor = $request->input('selected_color');
        if (!$selectedSku) {
            // Manejo de errores si no se selecciona un SKU
            return redirect()->back()->with('error', 'Por favor, seleccione un SKU.');
        }


        $colors = SizesModel::where('SKU', 'LIKE', $selectedSku . '%')->pluck('ColorId', 'ColorId');

        $articleColor = colorsModel::where('color_id',$colors)->value('color_id');

        $newSKU = $selectedSku . $selectedColor;
        // dd($newSKU);
        // Obtener todos los registros posibles que coincidan con el SKU seleccionado
        $stockData = fileModel::where('SKU', 'LIKE', $newSKU . '%')->get();
        $tallas = SizesModel::where('SKU', $newSKU)->value('sizes');


        $tallas = explode(',', $tallas); // Dividir la cadena en un array de tallas
        $tallasArray = [];
        foreach ($tallas as $talla) {
            $tallasArray[] = ['talla' => $talla];
        }
        
        // dd($tallasArray);
        // Inicializar un array para almacenar las cantidades por centro y talla
        $stockSize = [];

        // Filtrar y organizar los registros por centro y talla
        foreach ($stockData as $item) {
            $sku = $item->SKU;
            $centerId = $item->CenterId;
            $tallaSKU = substr($sku, -3); // Obtener los últimos 3 dígitos del SKU

            if (in_array($tallaSKU, $tallas)) {
                // Coincide con una talla, almacenar la cantidad correspondiente
                $stockSize[$centerId][$tallaSKU] = $item->Qty;
            }
        }
        

        $salesStoreGen = SalesStore::select('centerId', DB::raw('SUM(ventas) as ventas'))
            ->where('sku', $newSKU)
            ->groupBy('centerId')
            ->havingRaw('SUM(ventas) >= 0')
            ->orderBy('ventas', 'desc')
            ->get();



        // Actualiza $nivelServicio si es necesario (depende de cómo calcules el nivel de servicio)


       
        //------------------------------------------------------------------------------------------------------>
        // Inicializa una matriz para almacenar los resultados finales
        $result = []; // Inicializa un arreglo para almacenar los registros finales
        // dd($result);
        foreach ($salesStoreGen as $salesRecord) {
            $centerId = $salesRecord->centerId;
            $ventas = $salesRecord->ventas;
        
            $tallasCantidades = [];
        
            if (isset($stockSize[$centerId])) {
                foreach ($tallasArray as $tallaItem) {
                    $talla = $tallaItem['talla'];
        
                    $cantidad = isset($stockSize[$centerId][$talla]) ? $stockSize[$centerId][$talla] : 0;
        
                    $tallasCantidades[] = [
                        'talla' => $talla,
                        'cantidad' => $cantidad,
                    ];
                }
            }
        
            $record = [
                'centerId' => $centerId,
                'ventas' => $ventas,
                'tallas' => $tallasCantidades,
            ];
        
            $result[] = $record;
        }
        //  dd($result);

        return view('dashboard', compact('salesStoreGen', 'tallasArray', 'stockSize', 'selectedSku', 'result','colors'));
    }
}
