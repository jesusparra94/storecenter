<footer class="text-center" style="height: 60px; padding: 10px; ">

    @php
        $rem = '<div align="center"><span style="color: yellow;"><br><br><br><br><br><br><br>&nbsp;&nbsp; </span><br><br><br><br><br><br><br><br></div><span style="color: yellow;"></span></div>';
        $resultado = str_replace($rem, "", $footer->CON_VALOR);
    @endphp

    <small style="margin-bottom: 10px"> {!! $resultado !!} </small>

{{-- Hola --}}

</footer>