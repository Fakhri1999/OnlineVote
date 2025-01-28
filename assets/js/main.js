const baseUrl = `${window.location.origin}/`;

$(document).ready(function () {
  $('#numberOfCandidate').on('input', function () {
    let value = $('#numberOfCandidate').val();
    let render = '';

    if (value == 1 || value > 25) {
      return false;
    }

    for (let i = 0; i < value; i++) {
      render += `<div class="col-md-4"><div class="card mx-1 mb-3 shadow-sm"><div class="card-body">`;
      render += `<div class="custom-file mb-3"><input type="file" class="custom-file-input inputGroupFile" name="list${i}" id="inputGroupFile">`;
      render += `<label class="custom-file-label" for="inputGroupFile">Image files</label></div>`;
      render += `<input class="col-lg" type="text" name="list[${i}][nama_pilihan]" placeholder="Candidate name">`;
      render += `<input type="hidden" name="list[${i}][id_pilihan]" value=${generateCandidate()}>`;
      render += `</div></div></div>`;
    }
    $('.renderThis').html(render);
  });
});

function generateCandidate() {
  const listed =
    '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
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
    window.location.replace(`endVote/${code}`);
  }
};

const startVote = (code) => {
  if (confirm(`Are you sure want to start vote for room ${code} ?`)) {
    window.location.replace(`startVote/${code}`);
  }
};

const roomDetail = (code) => window.location.replace(`roomDetails/${code}`);

const deleteVote = (code) => {
  if (confirm(`Are you sure want to delete vote for room ${code} ?`)) {
    window.location.replace(`deleteVote/${code}`);
  }
};

const saveToFile = (code) => {
  Swal.fire({
    title: 'Choose files',
    html:
      `<button type="button" class="btn btn-md btn-outline-success mb-1 m-1" id="excel"><i class="fa fa-sticky-note"></i> Excel</button>` +
      `<button type="button" class="btn btn-md btn-outline-danger m-1" id="pdf"><i class="fa fa-sticky-note"></i> PDF</button>`,
    showCancelButton: false,
    showConfirmButton: false,
    onBeforeOpen: () => {
      const content = Swal.getContent();
      const $ = content.querySelector.bind(content);

      const excel = $('#excel');
      const pdf = $('#pdf');

      excel.addEventListener('click', function () {
        window.open(baseUrl + `saveToFile/${code}/excel`);
      });

      pdf.addEventListener('click', function () {
        window.open(baseUrl + `saveToFile/${code}/pdf`);
      });
    },
    onOpen: () => document.activeElement.blur(),
  });
};

$('#exampleModal').on('show.bs.modal', function (event) {
  // $('#myInput').trigger('focus')
  let btn = $(event.relatedTarget);
  $(this)
    .find('.modal-title')
    .text('Edit ' + btn.data('func'));

  let cond = btn.data('sembarang');
  console.log(cond);

  if (cond == 'paswd') {
    $('.labelModals').addClass('col-sm-4').removeClass('col-sm-2');
    $('.inputModals').addClass('col-sm-8').removeClass('col-sm-10');
    $('#formModal').attr('action', 'editPassword');
    $('#rowOne').html('Old Password');
    $('#inputOne').val('').attr('type', 'password');
    $('#rowTwo').html('New Password');
    $('#inputTwo').val('').attr('type', 'password');
    $('#rowThree').html('Confirm Password');
    $('#inputThree').val('').attr('type', 'password');
  } else {
    $('.labelModals').addClass('col-sm-2').removeClass('col-sm-4');
    $('.inputModals').addClass('col-sm-10').removeClass('col-sm-8');
    $('#formModal').attr('action', 'editProfile');
    $('#rowOne').html('Name');
    $('#rowTwo').html('Username');
    $('#rowThree').html('Email');
    $.ajax({
      url: baseUrl + 'getProfile',
      method: 'GET',
      success: function (data) {
        let result = JSON.parse(data);
        $('#inputOne').val(result.name).attr('type', 'text');
        $('#inputTwo').val(result.username).attr('type', 'text');
        $('#inputThree').val(result.email).attr('type', 'text');
      },
    });
  }
});

// Chart
const detailRoomCode = $('#detailRoomCode').val();
var resultData = [];
var resultLabels = [];
var resultColors = [];

const dataForChart = (code) => {
  if (!code) return false;
  $.ajax({
    url: baseUrl + 'detailVoteChart/' + code,
    method: 'GET',
    async: false,
    success: function (data) {
      data = JSON.parse(data);
      for (let i = 0; i < data.length; i++) {
        resultData.push(data[i].qty);
        resultLabels.push(data[i].nama_pilihan);
        resultColors.push(generateRandomColor());
      }
    },
  });
};

if (detailRoomCode != undefined) {
  dataForChart(detailRoomCode);
  const ctx = $('#chartResult');
  const myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      datasets: [
        {
          data: resultData,
          backgroundColor: resultColors,
          label: 'Dataset 1',
        },
      ],
      labels: resultLabels,
    },
    options: {
      responsive: true,
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 12,
        },
      },
    },
  });
}
