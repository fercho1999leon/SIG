<div class="row wrapper white-bg ">
    <div class="col-lg-12">
        <h2 class="title-page">Fichas Personales Estudiantiles</h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="col-lg-12">
        <div class="widget widget-tabs no-margin bg-none">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">General</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-2">Educación Inicial (EI)</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-3">Educación General Básica (EGB)</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-4">Bachillerato General Unificado (BGU)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="a-matricula__estudiantes">
                            <input type="text" id="admin-search" placeholder="Buscar..." class="inputSearch" onkeyup="myFunction()">
                        </div>
                        <div id="admin-list" class="director-profesores a-matricula__estudiantes">
                            @foreach($data as $student)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student->nombres}},{{ $student->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <h3 class="a-nombre__curso">
                            Inicial 1
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data2 as $student2)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student2->nombres}},{{ $student2->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Inicial 2
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data3 as $student3)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student3->nombres}},{{ $student3->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <h3 class="a-nombre__curso">
                            Primero
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data4 as $student4)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student4->nombres}},{{ $student4->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Segundo
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data5 as $student5)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student5->nombres}},{{ $student5->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Tercero
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data6 as $student6)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student6->nombres}},{{ $student6->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Cuarto
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data7 as $student7)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student7->nombres}},{{ $student7->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Quinto
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data8 as $student8)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student8->nombres}},{{ $student8->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Sexto
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data9 as $student9)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student9->nombres}},{{ $student9->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Séptimo
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data10 as $student10)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student10->nombres}},{{ $student10->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Octavo
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data11 as $student11)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student11->nombres}},{{ $student11->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Noveno
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data12 as $student12)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student12->nombres}},{{ $student12->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Décimo
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data13 as $student13)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student13->nombres}},{{ $student13->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <h3 class="a-nombre__curso">
                            Primero
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data14 as $student14)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student14->nombres}},{{ $student14->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Segundo
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data15 as $student15)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student15->nombres}},{{ $student15->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <h3 class="a-nombre__curso">
                            Tercero
                        </h3>
                        <div class="director-profesores a-matricula__estudiantes">
                            @foreach($data16 as $student16)
                            <div class="docente a-matricula__estudiantes-item">
                                <div class="representante">
                                    <p id="admin">{{ $student16->nombres}},{{ $student16->apellidos}}
                                        <span class="d-f ai-c">
                                            <a href="{{ route('studentsFiles.show', $student->id) }}">
                                                <i class="fa fa-eye a-fa-download__matricula"></i>
                                            </a>
                                            <a href="{{ route('studentsFiles.edit', $student->id) }}">
                                                <i class="fa fa-pencil a-fa-pencil__matricula"></i>
                                            </a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
