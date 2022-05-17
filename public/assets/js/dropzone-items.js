import Dropzone from "dropzone";
Dropzone.autoDiscover = false
let myDropzone = Dropzone({
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  acceptedFiles: ".jpg, .jpeg, .png, .gif",
  addRemoveLinks: true,
  dictDefaultMessage: "Drop files here to upload",
  dictRemoveFile: "Remove file",
  dictCancelUpload: "Cancel upload",
  dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
});