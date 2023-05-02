<div class="modal-dialog modal-lg">
    <div class="modal-content cuadrado">
        <div class="modal-header">
            <h4 class="modal-title">VISOR PDF</h4>
        </div>
        <div>
            <embed class="kv-preview-data file-preview-pdf file-zoom-detail" src="{{$url}}" type="application/pdf" style="width: 100%; height: 100%; min-height: 480px;" />
        </div>
    </div>
</div>
<style type="text/css">
    .cuadrado:before {
        content: "";
        position: absolute;
        top: -10px;
        left: calc(50% - 10px);
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #fff;
    }
</style>