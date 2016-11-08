function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');

    source = $('#customers')[0];

    specialElementHandlers = {
        '#bypassme': function (element, renderer) {
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        pdf.save('Test.pdf');
    }, margins);
}

function imprimirTabla() {
      $("#customers").printThis(
          {
            debug: true,
            importCSS: true,
            printContainer: false,
            loadCSS: "http://localhost/intranet/styles/requisicion.css",
            pageTitle: "Site Visit Form",
            removeInline: false
          }
      );

}
