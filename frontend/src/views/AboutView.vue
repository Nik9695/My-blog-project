<template>
  <main>
    <AboutArticleCard />
    <div class="section">
      <div class="section__inner section__inner--aboutArticle__page">
        <div class="aboutArticle__timeline">
          <div class="aboutArticle__date">08.08.2021</div>
          <div class="aboutArticle__timeline-divider"></div>
          <div class="aboutArticle__time">4 minutes</div>
        </div>
        <div class="aboutArticle__area">
          <div class="aboutArticle__area-content">
            <div class="aboutArticle__area-text">
              Seamlessly syndicate cutting-edge architectures rather than
              collaborative collaboration and idea-sharing. Proactively incubate
              visionary interfaces whereas premium benefits. Seamlessly
              negotiate ubiquitous leadership skills rather than parallel ideas.
              Dramatically visualize superior interfaces for best-of-breed
              alignments. Synergistically formulate performance based users
              through customized relationships. Interactively deliver
              cross-platform ROI via granular systems. Intrinsicly enhance
              effective initiatives vis-a-vis orthogonal outsourcing.
              Rapidiously monetize market-driven opportunities with
              multifunctional users. Collaboratively enhance visionary
              opportunities through revolutionary schemas. Progressively network
              just in time customer service without real-time scenarios.
            </div>
            <div class="aboutArticle__area-text">
              Synergistically drive e-business leadership with unique synergy.
              Compellingly seize market positioning ROI and bricks-and-clicks
              e-markets. Proactively myocardinate timely platforms through
              distributed ideas. Professionally optimize enabled core
              competencies for leading-edge sources. Professionally enhance
              stand-alone leadership with innovative synergy. Rapidiously
              generate backend experiences vis-a-vis long-term high-impact
              relationships. Authoritatively supply market-driven mindshare and
              bricks-and-clicks opportunities. Holisticly create diverse
              innovation through adaptive communities. Efficiently empower
              seamless meta-services with impactful opportunities. Distinctively
              transition virtual outsourcing with focused e-tailers.
            </div>
            <div
              class="aboutArticle__area-text aboutArticle__area-text--blockquote"
            >
              “ Monotonectally seize superior mindshare rather than efficient
              technology. ”
            </div>

            <div class="aboutArticle__area-text">
              Compellingly enhance seamless resources through competitive
              content. Continually actualize 24/365 alignments for
              resource-leveling platforms. Energistically enhance high standards
              in models and professional expertise. Intrinsicly iterate
              extensible metrics for prospective opportunities. Continually
              develop leading-edge experiences through quality e-services.
            </div>
          </div>
          <div class="aboutArticle__area-tags">
            <ul class="section__categories-list">
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >adventure</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >photo</RouterLink
              >
              <RouterLink to="/" class="aboutArticle__area-tag-item"
                >design</RouterLink
              >
            </ul>
          </div>
          <div class="aboutArticle__area-author">
            <div class="aboutArticle__area-author-info">
              <img
                src="@/assets/images/authorImage.jpg"
                class="aboutArticle__area-author-photo"
              />
              <div class="aboutArticle__area-author-content">
                <div class="aboutArticle__area-author-name">
                  By Jennifer Lawrence
                </div>
                <div class="aboutArticle__area-author-title">
                  Thinker & Designer
                </div>
              </div>
            </div>
            <div class="aboutArticle__area-author-social-networks">
              <a href="#" target="_blank">
                <i class="fa-brands fa-twitter"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-pinterest"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-facebook"></i>
              </a>
              <a href="#" target="_blank">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="section__inner">
        <h2 class="aboutArticle__section-heading">Related Posts</h2>
        <div class="section__articles">
          <ArticleCard v-for="i in 3" :key="i" />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import ArticleCard from '../components/article/ArticleCard.vue'
import AboutArticleCard from '../components/article/AboutArticleCard.vue'

export default {
  components: { ArticleCard, AboutArticleCard }
}
</script>
