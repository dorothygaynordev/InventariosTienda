<x-app-layout>
    <div class="py-5">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Document</title>

                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link
                        href="https://fonts.googleapis.com/css2?family=Jost&family=Montserrat:wght@300&family=Poppins:wght@200&family=Raleway:wght@600&display=swap"
                        rel="stylesheet">
                    <link href="nouislider.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>

                    @livewireStyles
                    <!-- In <body> -->
                </head>

                <body>
                    <script src="nouislider.min.js"></script>
                    <div class="container">
                        <div class="menu">
                            <div class="sidebar">
                                <div class="title">
                                    <form action="{{ route('searchArticle') }}" method="POST">
                                        @csrf
                                        <input type="text" name="selected_sku" placeholder="Ingrese el SKU manualmente (8 dígitos)" required>
                                        <button type="submit">Buscar</button>
                                    
                                    
                                    @if(isset($colors) && count($colors) > 0)
                                        
                                            @csrf
                                            <select name="selected_color">
                                                <option value=""></option>
                                                @foreach($colors as $colorId => $colorDescription)
                                                    <option value="{{ $colorId }}">{{ $colorDescription }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <button type="submit">Seleccionar</button> --}}
                                            @endif
                                        </form>
                                    
                                    
                                    
                                </div>
                                

                            </div>
                        </div>
                        <div class="table-container">
                            <table class="t">
                                <thead>
                                    <tr>
                                        <th>Centro</th>
                                        @if (!empty($tallasArray))
                                        @foreach ($tallasArray as $talla)
                                        <th>{{ $talla['talla'] }}</th>
                                        @endforeach
                                        @else
                                        <th>No hay tallas para mostrar</th>
                                        @endif
                                        <th>Ventas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($result))
                                        @foreach ($result as $salesItem)
                                            <tr>
                                                <td>{{ $salesItem['centerId'] }}</td>
                                                @if (!empty($tallasArray))
                                                @foreach ($tallasArray as $talla)
                                                <td>
                                                    @foreach ($salesItem['tallas'] as $tallaCantidad)
                                                    @if ($tallaCantidad['talla'] === $talla['talla'])
                                                    {{ intval($tallaCantidad['cantidad']) }}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                @endforeach
                                                @endif
                                                <td>{{ intval($salesItem['ventas']) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            </body>

            </html>
        </div>
    </div>
    </div>
</x-app-layout>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inicializa DataTable en la tabla con el ID "table"
        $('.t').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish_Mexico.json"
            },
            searching: false,
            lengthChange: false,
            info: false,
        });
    });
</script>
