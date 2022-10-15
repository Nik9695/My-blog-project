import { format, parseISO } from 'date-fns'

export default {
  computed: {
    formatDate() {
      const stringFromDate = parseISO(this.article.created_at)
      return format(stringFromDate, 'dd-MM-yyyy')
    }
  }
}
