// Morris.js Charts sample data for SB Admin template

$(function() {

    // Area Chart
    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            error: 2666,
        }, {
            period: '2010 Q2',
            error: 2778,
        }, {
            period: '2010 Q3',
            error: 4912,
        }, {
            period: '2010 Q4',
            error: 3767,
        }, {
            period: '2011 Q1',
            error: 6810,
        }, {
            period: '2011 Q2',
            error: 5670,
        }, {
            period: '2011 Q3',
            error: 4820,
        }, {
            period: '2011 Q4',
            error: 15073,
        }, {
            period: '2012 Q1',
            error: 10687,
        }, {
            period: '2012 Q2',
            error: 8432,
        }],
        xkey: 'period',
        ykeys: ['error'],
        labels: ['error'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    // Donut Chart
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Syntax Error",
            value: 12
        }, {
            label: "URl Error",
            value: 30
        }, {
            label: "Variable Error",
            value: 20
        }],
        resize: true
    });

    
   


});
