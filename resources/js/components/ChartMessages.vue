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
        getFormattedDate(date) {
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();
            var time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            return day + "." + month + "." + year + ", " + time;
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
                        console.log(this.apartmentName[i].created_at);

                        if (this.apartmentName[i]) {
                            this.ChartStatistic.data.datasets[0].data.push(i + 1);

                        }


                    }


                    console.log(this.apartmentName);
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
    <div class="cont-title">
        <canvas id="statistic-chart2"
            class="graph ">

        </canvas>
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