<template>
  <div class="card rounded shadow-sm objective-card">
    <div class="card-body">
      <div class="d-flex align-items-center flex-column flex-sm-row is-clickable" @click="showMore = !showMore">
        <div class="d-flex align-items-center mb-3 mb-sm-0 w-100">
          <div class="mr-4 category-icon-container" :style="`background-color: ${objective.category.background_color}`">
            <i class="fa-lg fa-fw" :class="objective.category.icon" :style="`color: ${objective.category.color}`"></i>
          </div>
          <div class="w-100">
            <span class="text-smallest" :style="`color:${objective.category.color}`">{{objective.category.title}}</span><br>
            <span class="text-dark h5 is-700">{{objective.title}}</span>
          </div>
        </div>
        <div class="d-flex align-items-center w-auto">
          <div class="mx-1 d-flex">
            <div class="text-center mx-2" style="width: 60px">
              <span class="is-700 is-size-5"><i class="fas fa-medal fa-fw text-primary"></i>{{objective.goals_count}}</span><br><span class="text-smaller">metas</span>
            </div>
            <div class="mx-2" style="width: 60px; display: flex; justify-content: center; align-items: center;">
            <goals-doughnut :chartData="chartData" :styles="chartStyle"></goals-doughnut>
            </div>
            <div class="text-center mx-2" style="width: 60px">
              <span class="is-700 is-size-5"><i class="far fa-file fa-fw text-primary"></i>{{objective.reports_count}}</span><br><span class="text-smaller">reportes</span>
            </div>
          </div>
          <div class="ml-1">
            <span class="text-primary"><i class="fas fa-lg fa-fw" :class="{'fa-chevron-up': showMore, 'fa-chevron-down': !showMore}"></i></span>
          </div>
        </div>
      </div>
      <div v-if="showMore">
        <hr>
        <div class="row my-2">
          <div class="col-md-6 col-lg-8">
            <b>Últimas metas actualizadas</b>
            <div class="my-1 d-flex justify-content-between align-items-center goal-container" v-for="goal in objective.latest_goals" :key="`goals_${goal.id}`">
              <span class="text-truncate w-100"><a :href="goal.url" class="text-dark">{{goal.title}}</a> <span :class="`text-${goal.status} text-smallest is-700`">({{goal.status_label}})</span></span>
              <div class="progress my-0 mx-1'" style="height: 10px; width: 150px" :title="goal.status_label">
                <div class="progress-bar" :class="`bg-${goal.status}`" role="progressbar" :style="`width:${goal.progress_percentage}%`" :aria-valuenow="goal.progress_percentage" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <span class="goal-percentage text-smallest is-700 ml-1">{{goal.progress_percentage}}%</span>
            </div>  
          </div>
          <div class="col-md-6 col-lg-4">
            <b>Últimos reportes</b>
            <div class="my-1 d-flex justify-content-between align-items-center report-container" v-for="report in objective.latest_reports" :key="`reports_${report.id}`">
              <span class="text-truncate w-100"><i class="far fa-file text-primary"></i>&nbsp;<a :href="report.url" class="text-dark w-100">&nbsp;{{report.title}}</a></span>
              <span class="report-icon text-smaller ml-1" :title="report.type_label"><i :class="`${report.type_icon} text-primary`"></i></span>
            </div>  
          </div>
        </div>
        <div class="mt-4 text-right">
          <a :href="objective.url" class="btn btn-outline-primary">Ver más&nbsp;<i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GoalsDoughnut from './GoalsDoughnut';

export default {
  props: ['objective'],
  data(){
    return {
      showMore: false,
      styles: {
        height: 45
      }
    }
  },
  components: {
    GoalsDoughnut
  },
  computed: {
    chartData: function(){
      return {
        labels: ['Alcanzadas','En progreso','No cumplida','Inactivas'],
        data: [
          this.objective.goals_status.reached ?? 0,
          this.objective.goals_status.ongoing ?? 0,
          this.objective.goals_status.delayed ?? 0,
          this.objective.goals_status.inactive ?? 0,
        ],
        labelsColors: ['#00b7ef','#f79200','#d172ae','#7e7e7e']
      }
    },
    chartStyle: function(){
      return {
        height: `${this.styles.height}px`,
        width: `${this.styles.height}px`,
        position: 'relative'
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.objective-card{
  .goal-container{
    .goal-percentage {
       min-width: 40px;
       text-align: left;
    }
  }
  .report-container{
    .report-icon {
       min-width: 30px;
       text-align: center;
    }
  }
  .progress:hover, .report-icon:hover{
    cursor: help;
  }
}
</style>