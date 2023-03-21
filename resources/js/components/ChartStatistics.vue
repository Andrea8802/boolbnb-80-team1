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


                    console.log(this.apartmentName);
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
        <div v-show="!display" class="ms_cont-title container">
            <div class="">No statistics available for this apartment</div>
        </div>
        <div v-show="display">

            <div class="ms_cont-title-one container-fluid container-lg mt-5">
                <canvas id="statistic-chart" class="graph ">

                </canvas>

            </div>

            <ChartMessages />


        </div>
    </div>
</template>

<style lang="scss" scoped>
.ms_cont-title {
    height: calc(100vh - 120px);
    display: flex;
    justify-content: center;
    align-items: center;

    div {
        font-size: 30px;
    }
}

.ms_cont-title-one {

    display: flex;
    justify-content: center;
    align-items: center;


    /* .graph {
        width: 90% !important;
        height: 90% !important;
    } */

}
</style>