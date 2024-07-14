jQuery(document).ready(function($) {
    if (typeof crmReportsData !== 'undefined') {
        console.log(crmReportsData);  // Add this line to check the data

        var charts = {};

        function initChart(chartId, chartType, chartData) {
            if (charts[chartId]) {
                charts[chartId].destroy();
            }

            var ctx = document.getElementById(chartId).getContext('2d');
            charts[chartId] = new Chart(ctx, {
                type: chartType,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: chartType === 'pie' ? {} : {
                        x: {
                            type: 'category',
                            display: true
                        },
                        y: {
                            type: 'linear',
                            display: true
                        }
                    }
                }
            });
        }

        // Initialize Deals Status Chart
        initChart('dealsStatusChart', 'pie', {
            labels: crmReportsData.dealsStatus.labels,
            datasets: [{
                data: crmReportsData.dealsStatus.data,
                backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56'],
            }]
        });

        // Initialize Contacts Over Time Chart
        initChart('contactsOverTimeChart', 'line', {
            labels: crmReportsData.contactsOverTime.labels,
            datasets: [{
                label: 'Contacts',
                data: crmReportsData.contactsOverTime.data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            }]
        });

        // Show modal with chart
        function showModal(canvasId, chartType, chartData) {
            var existingModal = $('#fullscreen-' + canvasId).closest('.fullscreen-chart');
            if (existingModal.length) {
                existingModal.remove();
                return; // If modal exists, remove it and exit the function
            }

            var fullscreenDiv = $('<div class="fullscreen-chart"></div>');
            var closeButton = $('<button class="close-button">&times;</button>');
            var fullscreenCanvas = $('<canvas></canvas>').attr('id', 'fullscreen-' + canvasId);
            fullscreenDiv.append(closeButton).append(fullscreenCanvas);
            $('body').append(fullscreenDiv);

            // Set fixed dimensions for the fullscreen canvas
            fullscreenCanvas.css({
                'width': '80vw',
                'height': '80vh'
            });

            var ctxFullscreen = document.getElementById('fullscreen-' + canvasId).getContext('2d');
            if (ctxFullscreen) {
                new Chart(ctxFullscreen, {
                    type: chartType,
                    data: chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: chartType === 'pie' ? {} : {
                            x: {
                                type: 'category',
                                display: true
                            },
                            y: {
                                type: 'linear',
                                display: true
                            }
                        }
                    }
                });
            } else {
                console.error('Canvas context not found');
            }

            closeButton.on('click', function() {
                fullscreenDiv.remove();
            });

            fullscreenDiv.on('click', function(event) {
                if (event.target === this) {
                    fullscreenDiv.remove();
                }
            });
        }

        // Click to enlarge charts
        $('.clickable-chart').on('click', function() {
            var canvasId = $(this).attr('id');
            var chartType = canvasId === 'dealsStatusChart' ? 'pie' : 'line';
            var chartData = charts[canvasId].config.data;

            showModal(canvasId, chartType, chartData);
        });
    }
});
