<aside class=" sidebar-dark-primary elevation-4 d-none d-xl-flex menusider" style="width:300px ">
    <div id="menu" class="sidebar" style="width: 100%">
      <nav class="mt-1">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item text-center">
                <form class="form-inline my-2 my-lg-0" action="{{url('/buscar')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input class="form-control" type="search" placeholder="Buscar Producto" aria-label="Search" name="nameproducto" required>
                    <button class="btn " type="submit" style="width: 20px"><i class="fas fa-search" style="color: #FFF"></i></button>
                </form>

            </li>

            @foreach($categorias as $key => $categoria)

            <li class="nav-item ">
                <a class="nav-link collapsed" data-toggle="collapse" href="#categorias{{$categoria->CAT_ID}}" role="button" aria-expanded="false" aria-controls="categorias{{$categoria->CAT_ID}}">

                    <span style="color:#FFF; text-transform: uppercase;">{{$categoria->CAT_NOMBRE}}</span>
                </a>
                <div class="collapse" style="" id="categorias{{$categoria->CAT_ID}}" style="background: #395870; color:#FFF;">
                    <div class=" py-2 p-2 collapse-inner rounded " style="background: #45647c">
                        <ul class="nav">
                            @foreach($subcategorias as $key => $subcategoria)
                                @foreach($subcategoria as $key => $sub)
                                    @if($sub->CAT_PADRE == $categoria->CAT_ID )

                                    <li class="nav-item" style="width:100% ">
                                        <a class="d-block" href="{{url('/listado/producto/'.$sub->CAT_ID)}}" style="color:#FFF; text-transform: uppercase; margin-bottom: 10px">{{$sub->CAT_NOMBRE}}</a>
                                    </li>

                                    @endif

                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>

            </li>



            @endforeach

            {{-- <li class="nav-item text-center">
                <a class="nav-link collapsed" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">

                    <span>Components 1</span>
                </a>
                <div class="collapse" style="" id="collapseExample1" style="background: #395870; color:#FFF;">
                    <div class=" py-2 p-2 collapse-inner rounded " style="background: #395870">
                        <ul class="nav">
                            <li class="nav-item" style="width:100% ">
                                <a class="d-block" href="" style="color:#FFF;">Item 1</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </li> --}}
        </ul>
      </nav>
    </div>
  </aside>


