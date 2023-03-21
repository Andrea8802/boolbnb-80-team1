<script>
import Chart from 'chart.js';
import axios from 'axios';
import ChartMessages from './ChartMessages.vue';

export default {
    components: {
        ChartMessages
    },
    data() {

        return {
            page: false,
            display: false,
            apartmentName: [],
            ChartStatistic: {
                type: "line",
                data: {
                    labels: [0],
                    datasets: [
                        {
                            label: "Number of Views",
                            data: [0],
                            backgroundColor: "rgba(54,73,93,.2)",
                            borderColor: "#36495d",
                            borderWidth: 3,
                            textStrokeWidth: "42"
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
                                    padding: 25,
                                    font: {
                                        fontSize: 45
                                    }
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


            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);
            axios.post('/api/getStatistics/' + this.$route.params.id, formData)
                .then(res => {

                    this.page = true;
                    // this.apartmentsName = res.data.apartmentStatistic[0];
                    this.apartmentName = res.data.apartmentStatistic;
                    if (this.apartmentName.length !== 0) {
                        this.display = true;
                    }
                    for (let i = 0; i < this.apartmentName.length; i++) {
                        this.ChartStatistic.data.labels.push(this.apartmentName[i].ip_date);

                        if (this.apartmentName[i]) {
                            this.ChartStatistic.data.datasets[0].data.push(i + 1);

                        }
                    }

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
    <div v-show="page">
        <div v-show="!display" class="cont-title"> <span>No statistics available for this apartment</span> </div>
        <div v-show="display">
            <div class="cont-title">
                <canvas id="statistic-chart" class="graph ">

                </canvas>

            </div>
            <ChartMessages />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.cont-title {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    span {
        font-size: 30px;
    }
}

.cont-title {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;


    .graph {
        width: 90% !important;
        height: 90% !important;
    }

}
</style>