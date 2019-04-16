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
         // render += `<span class="col-lg-12"><input type="file" name="list[][file]"></span>`;
         render += `<div class="custom-file mb-3"><input type="file" class="custom-file-input inputGroupFile" id="inputGroupFile">`;
         render += `<label class="custom-file-label" for="inputGroupFile">Image files</label></div>`;
         render += `<input class="col-lg" type="text" name="list[][nama]">`;
         render += `<input type="hidden" name="list[][pilihan]" value=${generateCandidate()}>`;
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

// Button func
const endVote = (code) => {
   if (confirm(`Are you sure want to end vote room ${code} ?`)) {
      window.location.replace(`endVote/${code}`)
   }
}

const roomDetail = (code) => window.location.replace(`roomDetails/${code}`)

$('#exampleModal').on('shown.bs.modal', function (event) {
   // $('#myInput').trigger('focus')
   let btn = $(event.relatedTarget)
   $(this).find('.modal-title').text("Edit " + btn.data('func'));

   let cond = btn.data('sembarang')
   console.log(cond)

   if (cond == 'paswd') {
      $('#formModal').attr('action', 'editPassword')
      $('#rowOne').html('Old Password')
      $('#nameModal').val('')
      $('#rowTwo').html('New Password')
      $('#usernameModal').val('')
      $('#rowThree').html('Confirm Password')
      $('#emailModal').val('')
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
            $('#nameModal').val(result.name)
            $('#usernameModal').val(result.username)
            $('#emailModal').val(result.email)
         }
      })
   }
})