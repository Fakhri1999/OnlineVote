const baseUrl = window.location.origin + "/onlinevote/";

$(document).ready(function () {
   console.log(new Date())
   $('#numberOfCandidate').on('input', function () {
      let value = $('#numberOfCandidate').val()
      let render = ''

      if (value < 2 || value > 25) {
         return false
      }

      for (let i = 0; i < parseInt(value); i++) {
         // Card
         render += `<div class="col col-4"><div class="card mx-1 mb-3 shadow-sm"><div class="card-body">`;

         render += `${generateCode()}`;

         // End div
         render += `</div></div></div>`;
      }
      console.log(render)
      $('.renderThis').html(render)
   })
})

const generateCode = () => {
   let code
   $.ajax({
      url: baseUrl + "/getCode",
      method: "GET",
      success: function (data) {
         console.log(data)
         code = data
      }
   })

   return code
}
// Button func
const endVote = (code) => {
   if (confirm(`Are you sure want to end vote room ${code} ?`)) {
      window.location.replace(`endVote/${code}`)
   }
}

const roomDetail = (code) => window.location.replace(`roomDetails/${code}`)