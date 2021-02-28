<aside class="main-sidebar sidebar-dark-primary sidebar-closed elevation-4 d-flex d-xl-none">
    <a  href="{{url('/')}}" class="brand-link a-logo">
      <img src="{{asset('img/logo.png')}}" alt="" style="height: 42px;  width: 100%; object-fit: contain;">
    </a>
    <div id="menu" class="sidebar" style="width: 100%">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item mt-4" style="width: 100%">
                <form action="{{url('/buscar')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="input-group" >
                        <input class="form-control" type="search" placeholder="Buscar Producto" aria-label="Search" name="nameproducto" required>
                        <div class="input-group-prepend" style="width:50px;display: flex;justify-content: center;align-items: center;">
                            <button type="submit" style="background-color:#234560;border:none;"><i class="fas fa-search" style="color: #FFF;"></i></button>
                        </div>

                    </div>
                </form>
            </li>


            @foreach($categorias as $key => $categoria)
                <li class="nav-item " style="width: 100%">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#categoriaside{{$categoria->CAT_ID}}" role="button" aria-expanded="false" aria-controls="categoriaside{{$categoria->CAT_ID}}">

                        <span style="color:#FFF; text-transform: uppercase;">{{$categoria->CAT_NOMBRE}}</span>
                    </a>
                    <div class="collapse" style="" id="categoriaside{{$categoria->CAT_ID}}" style="background: #395870; color:#FFF;">
                        <div class=" py-2 p-2 collapse-inner rounded " style="background: #395870">
                            <ul class="nav">
                                @foreach($subcategorias as $key => $subcategoria)
                                    @foreach($subcategoria as $key => $sub)
                                        @if($sub->CAT_PADRE == $categoria->CAT_ID )


                                        <li class="nav-item" style="width:100% ">
                                            <a class="d-block" href="{{url('/listado/producto/'.$sub->CAT_ID)}}" style="color:#FFF; text-transform: uppercase; margin-bottom: 10px">{{$sub->CAT_NOMBRE}}</a>
                                        </li>
                                        {{--
                                            @foreach($productos as $key => $producto)
                                                    @foreach($producto as $key => $pro)
                                                        {{"ID PRODUCTO".$pro->PRO_ID}}
                                                        {{"ID_SUBCATEGIRUA".$pro->CAT_ID}}
                                                    @endforeach
                                                @endforeach
                                        --}}


                                        {{--
                                            @foreach($productos as $key => $producto)
                                                    @foreach($producto as $key => $pro)
                                                        @if($pro->CAT_ID == $sub->CAT_ID )
                                                            <a class="d-block" href="{{url('/producto/'.$pro->PRO_ID)}}" style="color:#FFF; text-transform: uppercase; margin-bottom: 10px">{{$sub->CAT_NOMBRE}}</a>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                        --}}


                                        @endif

                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </li>
          @endforeach

      </ul>
      </nav>
    </div>
  </aside>
