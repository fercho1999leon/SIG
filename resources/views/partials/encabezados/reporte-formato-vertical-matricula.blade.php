<table class="table">
	<tr>
		<th rowspan="2" style="vertical-align:top !important;" class="no-border" width="10%">
			<div class="header__logo" style="float: left">
				<img width="200" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
				
			</div>
		</th>
		<th style="height:40px !important" width="65%"></th>
		<th rowspan="2" style="vertical-align:top !important;" class="no-border" width="30%">
			<div class="header__logo" style="float: left; margin-left: 50%">
				<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
	</tr>
	</table>
	<br>
	<table align="center" >	
	<tr>
		<td class="no-border">
			<div class="header__info text-center">
				<h1 class="uppercase" style="font-size: 12pt !important;">Certificado de matricula</h1>
				@php 
				$array_cadena = str_word_count($institution->nombre, 1);
				$num= count($array_cadena);
				if ($num % 2 ==0) {
					$primra_linea = $num/2;
					$segunda_linea = ($primra_linea*2);
				}else{
					$primra_linea = $num/2;
					$primra_linea= number_format($primra_linea,0);
					$segunda_linea = ($primra_linea*2)-1;
				}			
				@endphp				
				<h3 class="up" style="font-size: 12pt !important;">@for ($i = 0; $i <$primra_linea; $i++)
 				{{ $array_cadena[$i] }}&nbsp;
				@endfor</h3>
				<h3 class="up" style="font-size: 12pt !important;">@for ($j = $primra_linea; $j <$segunda_linea; $j++)
 				{{ $array_cadena[$j] }}&nbsp;
				@endfor</h3>
				<h3 class="up" style="font-size: 12pt !important;">{{ $institution->ciudad }} - ECUADOR</h3>				
			</div>
		</td>
	</tr>
</table>