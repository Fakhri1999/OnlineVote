<section class="container mt-3">
   <div class="row">
      <div class="col col-lg-12">
         <div class="card mb-3 shadow-sm">
            <div class="card-title mt-3">
               <h3 class="text-center">Detail Vote <?= $room[0]->judul; ?></h3>
               <input type="hidden" id="detailRoomCode" value="<?= $room[0]->kode_room; ?>">
            </div>
            <div class="card-body">
               <div class="align-content-center">
                  <canvas id="chartResult"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>