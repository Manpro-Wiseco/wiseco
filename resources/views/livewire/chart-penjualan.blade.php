<div class="form-group">
    <input wire:model="bulan_tahun" type="month" class="form-control" max="{{date('Y-m')}}">
</div>

<div class="chart">
    <canvas id="chart_penjualan" class="chart-canvas" height="300px"></canvas>
</div>
