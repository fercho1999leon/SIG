<!-- Redes Sociales -->
{!! Form::open(array('route' => 'editRedesSocialeslInstitucion')) !!}
<div class="grid-form">
    <p class="grid-form-p no-margin">Enlace a Facebook</p>
    {{ Form::text('facebook',$data->facebook,['class'=>'form-control','id'=>'fbInst','placeholder'=>'www.facebook.com'])}}
    <p class="grid-form-p no-margin">Enlace a Twitter</p>
    {{ Form::text('twitter',$data->twitter,['class'=>'form-control','id'=>'twtInst','placeholder'=>'www.twitter.com'])}}
    <p class="grid-form-p no-margin">Enlace a Youtube</p>
    {{ Form::text('youtube',$data->youtube,['class'=>'form-control','id'=>'ytInst','placeholder'=>'www.youtube.com'])}}
    <p class="grid-form-p no-margin">Enlace a Google</p>
    {{ Form::text('google',$data->google,['class'=>'form-control','id'=>'glgInst','placeholder'=>'www.google.com'])}}
    <p class="grid-form-p no-margin">Enlace a Instagram</p>
    {{ Form::text('instagram',$data->instagram,['class'=>'form-control','id'=>'instaInst','placeholder'=>'www.instagram.com'])}}
</div>
<div class="text-left mt-1">
    <input type="submit" value="Guardar" class="btn btn-success"> {!! Form::close() !!}
</div>
