import { format, parseISO, differenceInMinutes } from 'date-fns'

export default {
  computed: {
    formatDate() {
      const stringFromDate = parseISO(this.comment.created_at)
      return format(stringFromDate, 'dd-MM-yyyy')
    },

    commentLifeTime() {
      const created = parseISO(this.comment.created_at)
      const now = Date.now()
      return differenceInMinutes(now, created)
    }
  }
}
