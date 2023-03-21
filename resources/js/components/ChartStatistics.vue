<script>
import Chart from 'chart.js';
import axios from 'axios';

export default {
    data() {
        return {

            apartmentsName: [],
            ChartStatistic: {
                type: "line",
                data: {
                    labels: [new Date("2023-02-20"), new Date("2023-03-01"), new Date("2023-03-10")],
                    datasets: [
                        {
                            label: "Number of Views",
                            data: [0, 0, 0],
                            backgroundColor: "rgba(54,73,93,.5)",
                            borderColor: "#36495d",
                            borderWidth: 3
                        },

                    ]
                },
                options: {
                    responsive: true,
                    lineTension: 1,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                    padding: 25
                                }
                            }
                        ]
                    }
                }
            },


        }
    },
    methods: {
        getStatistics() {
            axios.get('/api/getStatistics')
                .then(res => {
                    this.apartmentsName = res.data.apartmentStatistic[0];
                    for (let i = 0; i < this.apartmentsName.length; i++) {
                        this.ChartStatistic.data.labels.push(new Date(this.apartmentsName[i].ip_date));
                        if (this.apartmentsName[i]) {
                            this.ChartStatistic.data.datasets[0].data.push(i + 1);
                        }

                        console.log(this.apartmentsName[i].length)
                    }

                    /* this.ChartStatistic.data.datasets[0].data = res.data.numViews ;
                    this.apartmentsName = res.data.apartmentsName;

                    /* res.data.viewsDate.forEach(element => {

                    }); */
                    /* for (let i = 0; i < res.data.viewsDate[0].length; i++) {
                        this.ChartStatistic.data.labels.push(res.data.viewsDate[0][i].ip_date);
                    } 
 */



                    console.log(this.apartmentsName);
                    const chart = document.getElementById('statistic-chart');
                    new Chart(chart, this.ChartStatistic);

                })
        }
    },
    mounted() {
        this.getStatistics();


    }
}
</script>

<template>
    <canvas id="statistic-chart">

    </canvas>
</template>

<style lang="scss" scoped></style>