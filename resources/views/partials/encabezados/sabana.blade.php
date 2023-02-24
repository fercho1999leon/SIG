<table class="table m-0">
	<tr>
		<th style="vertical-align:top" class="no-border" width="20%">
			<div class="header__logo" style="float: left">
				<img width="60" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="text-center">
				<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
				<h4 class="m-0 up">
					{{$titutloEncabezado}}
				</h4>
				<h4 class="m-0 bold uppercase"><small> año lectivo {{App\Institution::periodoLectivo()}} </small> </h4>
			</div>
		</th>
		<th class="no-border" width="20%">
				<div class="header__logo" style="float:right">
				<img width="200" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>