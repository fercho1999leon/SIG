<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="{{ route('setPeaStore')}}" method="POST"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-6">
                        <div class="row form-group">
                            <div class="col-xs-3 p-1">
                                <label for="nombre_pea">Nombre del PEA</label>
                            </div>
                            <div class="col-xs-9 p-1">
                                <input class="form-control" type="text" name="nombre_pea"
                                    id="nombre_pea" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-3 p-1">
                                <label for="carreraId">Carrera</label>
                            </div>
                            <div class="col-xs-9 p-1">
                                <select class="form-control" name="carreraId" id="carreraId" required>
                                    <option value="{{ -1 }}" selected>Seleccione</option>
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
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
                                    <option value="{{ -1 }}" selected>Seleccione</option>
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
                                    <option value="{{ -1 }}" selected>Seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-2 p-1">
                                <label for="asignaturaId">Materia</label>
                            </div>
                            <div class="col-xs-10 p-1">
                                <select class="form-control" name="asignaturaId" id="asignaturaId" required>
                                    <option value="{{ -1 }}" selected>Seleccione</option>
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
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 p-1">
                        <label for="filePea">Documento (PDF)</label>
                    </div>
                    <div class="col-xs-12 p-1">
                        <input type="file" name="filePea" id="filePea" accept=".pdf" class="file"
                            required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Agregar
                </button>
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar
                </button>
            </div>
        </form>
    </div>
</div>