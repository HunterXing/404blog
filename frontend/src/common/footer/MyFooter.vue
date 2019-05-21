<template>
  <div class="m-footer">
    <div class="content">
      <p>Copyright © 2019 notfound404 未寻. 当前呈现版本 19.05.12</p>
      <p>皖ICP备18018069号-1   个人学习博客</p>
      <p>仅个人学习使用</p>
      <p class="time">博客开发时间{{runningTime}}</p>

    </div>
  </div>
</template>

<script>
export default {
  name: 'MyFooter',
  data () {
    return {
      runningTime: 0
    }
  },
  created () {
    this.running()
  },
  methods: {
    running () {
      let startTime = new Date('2019/05/12 00:00:00')
      setInterval(() => {
        let time = new Date() - startTime
        let day = parseInt(time / 1000 / 60 / 60 / 24, 10)
        let hour = parseInt(time / 1000 / 60 / 60 % 24, 10)
        let minute = parseInt(time / 1000 / 60 % 60, 10)
        let second = parseInt(time / 1000 % 60, 10)
        this.runningTime = `${day}天${hour}小时${minute}分${second}秒`
      }, 1000)
    }
  }
}
</script>
