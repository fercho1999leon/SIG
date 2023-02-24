                <div class="panel pl-1 pr-1 matricula__matriculacion">
                    <div class="matricula__matriculacion-block">
                        <h3 class="matricula__matriculacion-title">DATOS PERSONALES</h3>
                        <div>
                            <div class="matricula__matriculacion__input">
                                <label for="estado" class="matricula__matriculacion-label">Estado</label>
                                <select class="form-control input-sm" name="estado">
                                    <option value="Activo">ACTIVO</option>
                                    <option value="Inactivo">INACTIVO</option>
                                </select>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="estado" class="matricula__matriculacion-label">Tipo</label>
                                <select class="form-control input-sm" name="estado">
                                    <option value="Natural">NATURAL</option>
                                    <option value="Juridico">JURIDICO</option>
                                    <option value="Sin_Ruc/Ci">Sin Ruc/CI</option>
                                </select>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label class="matricula__matriculacion-label">Contribuyente Especial</label>
                                <input type="checkbox" id="contribuyente" value="contribuyente">
                            </div>
                            <div></div><div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Ruc</label>
                                <input type="text" class="form-control input-sm" minlength="13" maxlength="13" value="" name="apellidos" value="" required>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Cédula</label>
                                <input type="text" class="form-control input-sm" minlength="10" maxlength="10" value="" name="apellidos" value="" required>
                            </div>
                            <div></div><div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Nombres</label>
                                <input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" value="" required>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Apellidos</label>
                                <input type="text" class="form-control input-sm" minlength="2" maxlength="100" value="" name="apellidos" value="" required>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Telefonos</label>
                                <input type="text" class="form-control input-sm" minlength="2" maxlength="100" value="" name="apellidos" value="" required>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Provincia</label>
                                <input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" value="" required>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Ciudad</label>
                                <input type="text" class="form-control input-sm" minlength="2" maxlength="100" value="" name="apellidos" value="" required>
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Dirección</label>
                                <input type="text" class="form-control input-sm" minlength="2" maxlength="100" value="" name="apellidos" value="" required>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Extranjero</label>
                                <input type="checkbox" id="extranjero" value="extranjero">
                            </div>
                        </div>
                    </div>
                    <div class="matricula__matriculacion-block">
                        <h3 class="matricula__matriculacion-title">PROVEEDOR</h3>
                        <div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">NOMBRE COMERCIAL</label>
                                <input type="text" class="form-control input-sm" name="ci" minlength="10" maxlength="255" placeholder="Ingrese el nombre comercial que dispone" value="" required>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Email</label>
                                <input type="text" class="form-control input-sm" minlength="2" maxlength="100" value="" name="apellidos" value="" required>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Descuento %</label>
                                <input type="number" class="form-control input-sm" min="0" max="100" value="" name="descuento" value="">
                            </div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">CIA</label>
                                <input type="checkbox" id="cia" value="cia">
                                <label for="" class="matricula__matriculacion-label">Artesano</label>
                                <input type="checkbox" id="artesano" value="artesano">
                            </div>
                            <div></div><div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Retencion IR</label>
                                <select class="form-control input-sm" name="retencion_ir">
                                    <option value="OPCION">OPCION</option>
                                </select>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Retención IVA</label>
                                <select class="form-control input-sm" name="retencion_iva">
                                    <option value="OPCION">OPCION</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="text-right">
                        <input type="submit" class="mb-1 btn btn-primary btn-lg" value="Crear_Proveedor">
                    </div>
                </div>