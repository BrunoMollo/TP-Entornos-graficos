<x-layout>
    <div class="container d-flex flex-column align-items-center">
        <h2 class="my-4">Nuevo Llamado</h2>
        <form>
            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input class="form-control" style="width: 300px;" id="puesto" rows="3" placeholder="Descripción del puesto"></textarea>
            </div>
            <div class="form-group">
                <label for="catedra">Cátedra</label>
                <select class="form-control" style="width: 300px;" id="catedra">
                    <option value="">Seleccionar cátedra</option>
                    <option value="catedra1">Cátedra 1</option>
                    <option value="catedra2">Cátedra 2</option>
                    <option value="catedra3">Cátedra 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha-cierre">Fecha de Cierre</label>
                <input type="date" class="form-control" style="width: 300px;" id="fecha-cierre">
            </div>
            <div class="form-group mt-4">
                <button type="button" class="btn btn-secondary mr-2" style="width: 100px;">Cancelar</button>
                <button type="button" class="btn btn-primary" style="width: 100px;">Guardar</button>
            </div>
        </form>
    </div>
</x-layout>
