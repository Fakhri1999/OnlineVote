<section class="container mt-3">
   <div class="row">
      <div class="col col-lg-12">
         <div class="card mb-3 shadow-sm">
            <div class="card-title mt-3">
               <h3 class="text-center">Detail Vote <?= $room[0]->judul; ?></h3>
               <input type="hidden" id="detailRoomCode" value="<?= $room[0]->kode_room; ?>">
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-12">
                     <div class="align-content-center">
                        <canvas id="chartResult"></canvas>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <!-- <div class="align-content-center"> -->
                     <form action="" method="post">
                        <div class="form-group">
                           <label>Title</label>
                           <input type="text" class="form-control" name="title" value="<?= $room[0]->judul; ?>" required>
                        </div>
                        <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" rows="5"><?= $room[0]->deskripsi; ?></textarea>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>Start at</label>
                              <input name="dateStart" id="datepicker1" value="<?= date('d/m/Y', strtotime($room[0]->waktu_pembuatan)) ?>" required>
                           </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>End at</label>
                              <input name="dateFinish" id="datepicker2" value="<?= date('d/m/Y', strtotime($room[0]->waktu_akhir)) ?>" required>
                           </div>
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>Candidate</label>
                              <input type="number" class="form-control" min="2" max="25" placeholder="2" readonly required>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="form-row mt-3">
                              <div class="col-md-12 text-right">
                                 <button class="btn btn-md btn-warning" type="submit">Update</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>