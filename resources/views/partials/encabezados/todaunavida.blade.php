<table class="table">
	<tr>
		<th style="vertical-align:top" class="no-border" width="20%">
			<div class="header__logo" style="float: left">
				<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
				<h4 class="m-0 up">
					{{$titutloEncabezado}}
				</h4>
				<h4 class="m-0 bold uppercase"><small> año lectivo {{$institution->periodoLectivo}} </small> </h4>
			</div>
		</th>
		<th class="no-border" width="20%">
				<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>