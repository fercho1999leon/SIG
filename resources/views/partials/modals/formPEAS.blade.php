<div class="modal-dialog modal-lg">
    @php
        //dd($document);
    @endphp
    <div class="modal-content">
        <form action="{{ route($flagUpdate==='true'?'setEditPEA':'setPeaStore')}}" method="POST"
            enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-6">
                        <div class="row form-group">
                            <div class="col-xs-3 p-1">
                                <label for="nombre_pea">Nombre del PEA</label>
                            </div>
                            <div class="col-xs-9 p-1">
                                <input class="form-control" type="text" name="nombre_pea"
                                    id="nombre_pea" required value="{{$flagUpdate==='true'?explode('-',$document->name)[1]:''}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-3 p-1">
                                <label for="carreraId">Carrera</label>
                            </div>
                            <div class="col-xs-9 p-1">
                                <select class="form-control" name="carreraId" id="carreraId" required>
                                    <option value="{{ -1 }}" {{$flagUpdate==='true'?"":"selected"}}>Seleccione</option>
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" {{$flagUpdate==='true'?$document->idCarrera==$carrera->id?"selected":"":""}}>{{ $carrera->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-3 p-1">
                                <label for="semestreId">Semestre</label>
                            </div>
                            <div class="col-xs-9 p-1">
                                <select class="form-control" name="semestreId" id="semestreId" required>
                                    <option value="{{ -1 }}" {{$flagUpdate==='true'?"":"selected"}}>Seleccione</option>
                                    @if ($flagUpdate==='true')
                                        @foreach ($semestres as $semestre)
                                            <option value="{{ $semestre->id }}" {{$flagUpdate==='true'?$document->idSemestre==$semestre->id?"selected":"":""}}>{{ $semestre->nombsemt }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row form-group">
                            <div class="col-xs-2 p-1">
                                <label for="cursoId">Curso</label>
                            </div>
                            <div class="col-xs-10 p-1">
                                <select class="form-control" name="cursoId" id="cursoId" required>
                                    <option value="{{ -1 }}" {{$flagUpdate==='true'?"":"selected"}}>Seleccione</option>
                                    @if ($flagUpdate==='true')
                                        @foreach ($cursos as $curso)
                                            <option value="{{ $curso->id }}" {{$flagUpdate==='true'?$document->idCurso==$curso->id?"selected":"":""}}>{{ $curso->paralelo }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 p-1">
                                <label for="asignaturaId">Materia</label>
                            </div>
                            <div class="col-xs-10 p-1">
                                <select class="form-control" name="asignaturaId" id="asignaturaId" required>
                                    <option value="{{ -1 }}" {{$flagUpdate==='true'?"":"selected"}}>Seleccione</option>
                                    @if ($flagUpdate==='true')
                                        @foreach ($asignaturas as $asignatura)
                                            <option value="{{ $asignatura->id }}" {{$flagUpdate==='true'?$document->idMetter==$asignatura->id?"selected":"":""}}>{{ $asignatura->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 p-1">
                                <label for="estado">Estado</label>
                            </div>
                            <div class="col-xs-10 p-1">
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="0">Inactivo</option>
                                    <option value="1" {{$document->state===1?"selected":""}}>Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($flagUpdate==="false")
                    <div class="row form-group">
                        <div class="col-xs-12 p-1">
                            <label for="filePea">Documento (PDF)</label>
                        </div>
                        <div class="col-xs-12 p-1">
                            <input type="file" name="filePea" id="filePea" accept=".pdf" class="file"
                                required>
                        </div>
                    </div>
                @endif
                @if ($flagUpdate==="true")
                    <input class="form-control" type="hidden" name="idPEA"
                    id="idPEA" required value="{{$idUpdate}}">
                @endif             
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    {{$flagUpdate==="true"?'Actualizar':'Agregar'}}
                </button>
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    $(function () {
        $('#carreraId').on('change', onSelectSemestre);
    });
    $(function () {
        $('#semestreId').on('change', onSelectParalelo);
    });
    $(function () {
        $('#cursoId').on('change', onSelectMateria);
    });
</script>