/**
 * Created by mayrazevedo on 18/04/17.
 */
$(function () {
    // Prepare demo data
    var data = [
        {
            "hc-key": "br-sp",
            "value": $('#20106').val()? $('#20106').val() :null
        },
        {
            "hc-key": "br-ma",
            "value": $('#20093').val()? $('#20093').val() :null
        },
        {
            "hc-key": "br-pa",
            "value": $('#20097').val()? $('#20097').val() :null
        },
        {
            "hc-key": "br-sc",
            "value": $('#20105').val()? $('#20105').val() :null
        },
        {
            "hc-key": "br-ba",
            "value": $('#20088').val()? $('#20088').val() :null
        },
        {
            "hc-key": "br-ap",
            "value": $('#21226').val()? $('#21226').val() :null
        },
        {
            "hc-key": "br-ms",
            "value": $('#20095').val()? $('#20095').val() :null
        },
        {
            "hc-key": "br-mg",
            "value": $('#20094').val()? $('#20094').val() :null
        },
        {
            "hc-key": "br-go",
            "value": $('#20092').val()? $('#20092').val() :null
        },
        {
            "hc-key": "br-rs",
            "value": $('#20104').val()? $('#20104').val() :null
        },
        {
            "hc-key": "br-to",
            "value": $('#21230').val()? $('#21230').val() :null
        },
        {
            "hc-key": "br-pi",
            "value": $('#20100').val()? $('#20100').val() :null
        },
        {
            "hc-key": "br-al",
            "value": $('#20086').val()? $('#20086').val() :null
        },
        {
            "hc-key": "br-pb",
            "value": $('#20098').val()? $('#20098').val() :null
        },
        {
            "hc-key": "br-ce",
            "value": $('#20089').val()? $('#20089').val() :null
        },
        {
            "hc-key": "br-se",
            "value": $('#21229').val()? $('#21229').val() :null
        },
        {
            "hc-key": "br-rr",
            "value": $('#21228').val()? $('#21228').val() :null
        },
        {
            "hc-key": "br-pe",
            "value": $('#20099').val()? $('#20099').val() :null
        },
        {
            "hc-key": "br-pr",
            "value": $('#20101').val()? $('#20101').val() :null
        },
        {
            "hc-key": "br-es",
            "value": $('#20091').val()? $('#20091').val() :null
        },
        {
            "hc-key": "br-rj",
            "value":  $('#20102').val()? $('#20102').val() :null
        },
        {
            "hc-key": "br-rn",
            "value": $('#20103').val()? $('#20103').val() :null
        },
        {
            "hc-key": "br-am",
            "value": $('#20087').val()? $('#20087').val() :null
        },
        {
            "hc-key": "br-mt",
            "value": $('#20096').val()? $('#20096').val() :null
        },
        {
            "hc-key": "br-df",
            "value": $('#20090').val()? $('#20090').val() :null
        },
        {
            "hc-key": "br-ac",
            "value": $('#21232').val()? $('#21232').val() :null
        },
        {
            "hc-key": "br-ro",
            "value": $('#21227').val()? $('#21227').val() :null
        }
    ];
    var max = 1;
    for(i = 0; i < data.length; ++i){
        if(data[i].value > max){
            max = parseInt(data[i].value);
        }
    }

    // Initiate the chart
    $('#mapa_brasil').highcharts('Map', {

        title : {
            text : ''
        },

        lang: {
            downloadJPEG: 'Baixar imagem em JPEG',
            downloadPDF: 'Baixar documento em PDF',
            downloadPNG: 'Baixar imagem em PNG',
            downloadSVG: 'Baixar imagem vetorial em SVG',
            printChart: 'Imprimir gráfico'
        },

        chart: {
            backgroundColor: '',
        },


        subtitle : {
            text : ''
        },

        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 1,
            max: max,
            type: 'logarithmic',
            minColor: '#E6EBF5',
            maxColor: '#001FA1'
        },

        series : [{
            data : data,
            mapData: Highcharts.maps['countries/br/br-all'],
            joinBy: 'hc-key',
            name: 'Estado',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            dataLabels: {
                enabled: false,
            }
        }]
    });
});