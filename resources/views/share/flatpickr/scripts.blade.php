<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
  flatpickr(document.getElementById('finish_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d H:i",
    minDate: new Date(),
    enableTime: true
  });
</script>


