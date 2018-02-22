import Highcharts from 'highcharts/highmaps';

export default class {
    constructor(container, options = {}) {
        const callbacks = { select: [], unselect: [] };

        this.container = container;
        this.callbacks = callbacks;
        this.options = Object.assign({
            title: {
                text: '',
            },
            colorAxis: {

                stops: [
                    [0, '#E6EBF5'],
                    [1, '#3943a1'],
                    [20, '#001FA1']
                ],
                min: 0
            },
            credits: false,
            plotOptions: {
                map: {
                    nullColor: '#f39c12',
                    borderColor: 'white',
                },
            },
            tooltip: {
                headerFormat: '<span style="color:#0060B2;">{point.key}</span><table>',
                pointFormat: '<tr><td style="font-size:10px;;padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.value}</b></td></tr>',
                footerFormat: '</table>',
                useHTML: true
            },
            series: [{
                id: 'polygons',
                color: '#f39c12',
                joinBy: ['id', 'key'],
                data: [],
                showInLegend: false,
                cursor: 'pointer',
            }],
        }, options);
    }

    getOptions() {
        return this.options;
    }

    setData(data) {

        this.chart.get('polygons').setData(data, true, true, false);


        return this;
    }

    onSelect(callback) {
        this.callbacks.select.push(callback);

        return this;
    }

    onUnselect(callback) {
        this.callbacks.unselect.push(callback);

        return this;
    }

    render() {
        this.chart = Highcharts.mapChart(this.container, this.options);

        return this;
    }

    clearSelection() {
        this.chart.getSelectedPoints().forEach(point => point.select(false));

        return this;
    }

    setTitle(title, i) {
        this.chart.series[i].update({
            name: title
        });

        return this;
    }

    setLink(link) {
        this.chart.update({
            plotOptions: {
                series: {
                    point: {
                        events: {
                            click: function () {
                                window.location.href = link + "/"+this.key;
                            }
                        }
                    }
                }
            },
        });

        return this;
    }


}
