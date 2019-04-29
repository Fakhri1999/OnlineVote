<section class="container mt-3">
   <div class="row">
      <div class="col col-lg-12">
         <div class="card mb-3 shadow-sm">
            <div class="card-title mt-3">
               <h3 class="text-center">Vote Results of <?= $room[0]->judul; ?></h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-12">
                     <div class="align-content-center">
                        <input type="hidden" name="roomCode" id="detailRoomCode" value="<?= $room[0]->kode_room; ?>">
                        <?php if ($chart[0]->total == 0) : ?>
                           <h3 class="display-1">No one voted</h3>
                        <?php else : ?>
                           <canvas id="chartResult"></canvas>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>