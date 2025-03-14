<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow-md dark:bg-gray-800" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$store.theme = { update: (theme) => { localStorage.setItem('theme', theme); darkMode = theme === 'dark'; } }">
        <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Site Analytics</h2>


        <div>
            <h3 class="mb-2 font-semibold text-gray-800 dark:text-gray-200">User Visits and Courses Created Over Time</h3>
            <canvas id="combinedChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // استدلال الوضع من localStorage
            const currentTheme = localStorage.getItem('theme') || 'light'; // القيمة الافتراضية هي 'light'
    
            // تحديد اللون بناءً على الوضع
            const getTextColor = (theme) => theme === 'dark' ? '#FFFFFF' : '#333333'; // لون النص في الوضع الداكن أو الفاتح
            const textColor = getTextColor(currentTheme);
    
            // رسم الشارتين معاً في نفس العنصر
            const combinedCtx = document.getElementById('combinedChart').getContext('2d');

            console.log('textColor:', textColor);

            let combinedChart = new Chart(combinedCtx, {
                type: 'line',
                data: {
                    labels: @json($visitChartData['labels']),  // نفس التسميات للـ x-axis
                    datasets: [
                        {
                            label: 'User Visits',
                            data: @json($visitChartData['data']),
                            borderColor: '#4CAF50',
                            backgroundColor: 'rgba(76, 175, 80, 0.2)',
                            borderWidth: 2,
                            fill: true,
                        },
                        {
                            label: 'Courses Created',
                            data: @json($courseChartData['data']),
                            borderColor: '#2196F3',
                            backgroundColor: 'rgba(33, 150, 243, 0.2)',
                            borderWidth: 2,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: textColor // استخدام اللون المناسب وفقاً للوضع
                            }
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                                color: textColor // استخدام اللون المناسب للعنوان
                            },
                            ticks: {
                                color: textColor // استخدام اللون المناسب للتسميات
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Count',
                                color: textColor // استخدام اللون المناسب للعنوان
                            },
                            ticks: {
                                color: textColor // استخدام اللون المناسب للتسميات
                            },
                            beginAtZero: true,
                        },
                    },
                }
            });
    
            // الاستماع لتغيير الوضع وتحديث الشارت
            window.addEventListener('storage', function(event) {
                if (event.key === 'theme') {
                    const updatedTheme = localStorage.getItem('theme');
                    const updatedTextColor = getTextColor(updatedTheme);
    
                    // تحديث الألوان في الشارت
                    combinedChart.options.plugins.legend.labels.color = updatedTextColor;
                    combinedChart.options.scales.x.title.color = updatedTextColor;
                    combinedChart.options.scales.x.ticks.color = updatedTextColor;
                    combinedChart.options.scales.y.title.color = updatedTextColor;
                    combinedChart.options.scales.y.ticks.color = updatedTextColor;
    
                    // إعادة رسم الشارت بعد تغيير الألوان
                    combinedChart.update();
                }
            });
        });
    </script>
</x-app-layout>
