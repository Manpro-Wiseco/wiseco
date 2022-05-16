<div class="form-group">
    <input wire:model="bulan_tahun" type="month" class="form-control" max="{{date('Y-m')}}">
</div>

<div class="chart">
    <canvas id="chart_pembelian" class="chart-canvas" height="250px"></canvas>
</div>
