function confirmLogout() {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, logout!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "?p=logout";
    }
  });
}

function confirmDelete(id) {
  Swal.fire({
    title: "Are you sure you want to delete this E-Book?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "?p=deleteebook&id=" + id;
    }
  });
}

function showDeleteSuccessMessage(message) {
  Swal.fire({
    title: "Success",
    text: message,
    icon: "success",
    confirmButtonText: "OK",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "?p=list-ebook";
    }
  });
}

if (Notification.permission !== "granted") {
  Notification.requestPermission();
}

function notifyUser() {
  if (Notification.permission === "granted") {
    new Notification("Warning", {
      body: "You cannot switch tabs while viewing the PDF.",
      icon: "path/to/warning-icon.png",
    });
  }
}

let overlay = document.createElement("div");
overlay.style.position = "fixed";
overlay.style.top = 0;
overlay.style.left = 0;
overlay.style.width = "100%";
overlay.style.height = "100%";
overlay.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
overlay.style.zIndex = 1050;
overlay.style.display = "none";
overlay.id = "pdfOverlay";

document.body.appendChild(overlay);

function viewPDF(filePath, ebookName) {
  var url = encodeURI(filePath);

  var pdfjsLib = window["pdfjs-dist/build/pdf"];
  pdfjsLib.GlobalWorkerOptions.workerSrc =
    "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.worker.min.js";

  var loadingTask = pdfjsLib.getDocument(url);
  loadingTask.promise.then(function (pdf) {
    var totalPages = pdf.numPages;
    var container = document.getElementById("pdfContainer");
    container.innerHTML = "";

    for (var pageNum = 1; pageNum <= totalPages; pageNum++) {
      pdf.getPage(pageNum).then(function (page) {
        var scale = 1;
        var viewport = page.getViewport({
          scale: scale,
        });

        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        var renderContext = {
          canvasContext: context,
          viewport: viewport,
        };

        container.appendChild(canvas);
        page.render(renderContext).promise.then(function () {
          var containerWidth = container.clientWidth;
          var scaleRatio = containerWidth / canvas.width;
          canvas.style.width = containerWidth + "px";
          canvas.style.height = canvas.height * scaleRatio + "px";
          canvas.style.display = "block";
          canvas.style.margin = "0 auto";
          canvas.style.borderBlockEnd = "1px solid";
        });
      });
    }
  });

  document.getElementById("pdfModalLabel").innerText = ebookName;
  var myModal = new bootstrap.Modal(document.getElementById("pdfModal"));
  myModal.show();

  document.addEventListener("visibilitychange", handleVisibilityChange);
}

function handleVisibilityChange() {
  if (document.hidden) {
    document.getElementById("pdfOverlay").style.display = "block";
    Swal.fire({
      title: "Warning!",
      text: "You cannot switch tabs while viewing the PDF.",
      icon: "warning",
      confirmButtonText: "OK",
    });
    notifyUser();
  } else {
    if (overlay) overlay.style.display = "none";
  }
}

document
  .getElementById("pdfModal")
  .addEventListener("hidden.bs.modal", function () {
    document.removeEventListener("visibilitychange", handleVisibilityChange);
  });
