<script>
import Chart from 'chart.js';
import axios from 'axios';

export default {
    data() {
        return {
            display: false,
            apartmentName: [],
            ChartStatistic: {
                type: "line",
                data: {
                    labels: [0],
                    datasets: [
                        {
                            label: "Number of Messages",
                            data: [0],
                            backgroundColor: "rgba(20,132,143,.2)",
                            borderColor: "#14848f",
                            borderWidth: 3,
                            textStrokeWidth: "42"
                        },

                    ]
                },
                options: {

                    legend: {
                        labels: {
                            fontSize: 18,
                        }
                    },

                    responsive: true,
                    lineTension: 1,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                    padding: 25,
                                    fontSize: 18,
                                }
                            }
                        ],
                        xAxes: [
                            {

                                ticks: {
                                    padding: 10,
                                    fontSize: 16,
                                }
                            }
                        ]
                    },
                }
            },


        }
    },
    methods: {
        getFormattedDate(date) {
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();
            // var time = date.getHours() + ":" + date.getMinutes();
            return year + "-" + month + "-" + day;
        },
        getMessagesStat() {


            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);
            axios.post('/api/getMessagesStat/' + this.$route.params.id, formData)
                .then(res => {


                    // this.apartmentsName = res.data.apartmentStatistic[0];
                    this.apartmentName = res.data.apartmentMessage;
                    if (this.apartmentName.length !== 0) {
                        this.display = true;
                    }
                    for (let i = 0; i < this.apartmentName.length; i++) {
                        this.ChartStatistic.data.labels.push((this.getFormattedDate(new Date(this.apartmentName[i].created_at))));

                        if (this.apartmentName[i]) {
                            this.ChartStatistic.data.datasets[0].data.push(i + 1);

                        }


                    }

                    const chart = document.getElementById('statistic-chart2');
                    new Chart(chart, this.ChartStatistic);

                })
        }
    },
    mounted() {
        this.getMessagesStat();


    }
}
</script>

<template>
    <br>
    <h2 v-show="this.display"
        class="mt-3 text-center">People who wrote you:</h2>
    <div v-show="this.display"
        class="ms_cont-title container-fluid container-lg mt-5">
        <canvas id="statistic-chart2"
            class="graph">

        </canvas>
    </div>
    <div v-show="!this.display"
        class="mt-5">
        <h5 class="text-center">You haven't yet received any messages for this apartment</h5>
    </div>
</template>

<style lang="scss" scoped>
.ms_cont-title {
    display: flex;
    justify-content: center;
    align-items: center;

    span {
        font-size: 30px;
    }
}

.ms_cont-title {
    display: flex;
    justify-content: center;
    align-items: center;


    /* .graph {
        width: 90% !important;
        height: 90% !important;
    } */

}
</style>