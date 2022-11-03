import { format, parseISO, differenceInMinutes } from 'date-fns'

export default {
  computed: {
    formatDate() {
      const stringFromDate = parseISO(this.article.created_at)
      return format(stringFromDate, 'dd-MM-yyyy')
    },
    shortContent() {
      return `${this.article.content
        .replace(/(<([^>]+)>)/gi, '')
        .slice(0, 100)}`
    },
    articleLifeTime() {
      const created = parseISO(this.article.created_at)
      const now = Date.now()
      return differenceInMinutes(now, created)
    }
  }
}
