<div class="row">
  <div class="col-md-12">
    <div class="row top_tiles" style="margin: 10px 0;">
      <div class="col-md-3 tile">
       <span>Penerimaan Hari Ini</span>
       <h2><?php echo number_format($hariini['jmlbayar'],'0','','.'); ?></h2>
       <span class="sparkline_two" style="height: 160px;">
          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
       </span>
      </div>
      <div class="col-md-3 tile">
       <span>Penerimaan Bulan Ini</span>
       <h2><?php echo number_format($bulanini['jmlbayar'],'0','','.'); ?></h2>
       <span class="sparkline_two" style="height: 160px;">
          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
       </span>
      </div>
      <div class="col-md-3 tile">
       <span>Penerimaan Tahun Ini</span>
       <h2><?php echo number_format($tahunini['jmlbayar'],'0','','.'); ?></h2>
       <span class="sparkline_two" style="height: 160px;">
          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
       </span>
      </div>
    </div>
  </div>
</div>
