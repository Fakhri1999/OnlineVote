const baseUrl = window.location.origin + "/onlinevote/";
console.log(new Date())

$(document).ready(function () {
   $('#numberOfCandidate').on('input', function () {
      let value = $('#numberOfCandidate').val()
      let render = ''

      if (value == 1 || value > 25) {
         return false
      }

      for (let i = 0; i < value; i++) {
         render += `<div class="col-md-4"><div class="card mx-1 mb-3 shadow-sm"><div class="card-body">`;
         render += `<div class="custom-file mb-3"><input type="file" class="custom-file-input inputGroupFile" name="list[${i}][foto]" id="inputGroupFile">`;
         render += `<label class="custom-file-label" for="inputGroupFile">Image files</label></div>`;
         render += `<input class="col-lg" type="text" name="list[${i}][nama_pilihan]">`;
         render += `<input type="hidden" name="list[${i}][id_pilihan]" value=${generateCandidate()}>`;
         render += `</div></div></div>`;
      }
      $('.renderThis').html(render)
   })
})

function generateCandidate() {
   const listed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
   let generatedCode = '';
   for (let i = 0; i < 8; i++) {
      generatedCode += listed.charAt(Math.random() * listed.length - 1);
   }

   return generatedCode;
}

function generateRandomColor() {
   var hexList = '0123456789ABCDEF';
   var color = '#';
   for (var i = 0; i < 6; i++) {
      color += hexList[Math.floor(Math.random() * 16)];
   }
   return color;
}

// Button func
const endVote = (code) => {
   if (confirm(`Are you sure want to end vote for room ${code} ?`)) {
      window.location.replace(`endVote/${code}`)
   }
}

const startVote = (code) => {
   if (confirm(`Are you sure want to start vote for room ${code} ?`)) {
      window.location.replace(`startVote/${code}`)
   }
}

const roomDetail = (code) => window.location.replace(`roomDetails/${code}`)

$('#exampleModal').on('show.bs.modal', function (event) {
   // $('#myInput').trigger('focus')
   let btn = $(event.relatedTarget)
   $(this).find('.modal-title').text("Edit " + btn.data('func'));

   let cond = btn.data('sembarang')
   console.log(cond)

   if (cond == 'paswd') {
      $('#formModal').attr('action', 'editPassword')
      $('#rowOne').html('Old Password')
      $('#inputOne').val('').attr('type', 'password')
      $('#rowTwo').html('New Password')
      $('#inputTwo').val('').attr('type', 'password')
      $('#rowThree').html('Confirm Password')
      $('#inputThree').val('').attr('type', 'password')
   } else {
      $('#formModal').attr('action', 'editProfile')
      $('#rowOne').html('Name')
      $('#rowTwo').html('Username')
      $('#rowThree').html('Email')
      $.ajax({
         url: baseUrl + "getProfile",
         method: "GET",
         success: function (data) {
            let result = JSON.parse(data)
            $('#inputOne').val(result.name).attr('type', 'text')
            $('#inputTwo').val(result.username).attr('type', 'text')
            $('#inputThree').val(result.email).attr('type', 'text')
         }
      })
   }
})

// Chart
const detailRoomCode = $('#detailRoomCode').val()
var resultData = []
var resultLabels = []
var resultColors = []

const dataForChart = (code) => {
   if (!code) return false
   $.ajax({
      url: baseUrl + 'detailVoteChart/' + code,
      method: 'GET',
      async: false,
      success: function (data) {
         data = JSON.parse(data)
         for (let i = 0; i < data.length; i++) {
            resultData.push(data[i].qty)
            resultLabels.push(data[i].nama_pilihan)
            resultColors.push(generateRandomColor())
         }
      }
   })
}

if (detailRoomCode != undefined) {
   dataForChart(detailRoomCode)
   const ctx = $('#chartResult');
   const myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
         datasets: [{
            data: resultData,
            backgroundColor: resultColors,
            label: 'Dataset 1'
         }],
         labels: resultLabels
      },
      options: {
         responsive: true,
         legend: {
            display: true,
            position: "bottom",
            labels: {
               fontColor: "#333",
               fontSize: 12
            }
         }
      }
   });
}