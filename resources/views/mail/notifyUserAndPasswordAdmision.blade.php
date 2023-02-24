@php
    use Illuminate\Support\Facades\File;
@endphp
<div id="content-mail">
    <img src="{{Storage::url('logo/ISTRED.png')}}" style="height: 20vh; width: fit-content; align-self: center;">
    <span >ADMISION - CREDENCIALES DE ACCESO</span>
    <table>
        <tr style="background-color: #f46300; height: 30px; color: white;">
            <th>USUARIO</th>
            <th>CONTRASEÑA</th>
        </tr>
        @foreach($credentials as $credential)
            <tr>
                <th style="font-weight: 300;">{{$credential['user']}}</th>
                <th style="font-weight: 300;">{{$credential['pass']}}</th>
            </tr>
        @endforeach
    </table>
</div>
<style>
    #content-mail{
        display: flex;
        flex-direction: column;
    }
    #content-mail > span{
        background-color: #21376d;
        color: white;
        text-align: center;
        height: auto;
        padding-top: 10px;
        padding-bottom: 10px;
        line-height: 40px;
        font-family: sans-serif;
        font-weight: bold;
    }
    #content-mail > table{
        margin-top: 30px;
        font-family: sans-serif;
    }
</style>
