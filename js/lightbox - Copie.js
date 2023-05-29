console.log('lightbox')

class lightbox {
    // permet initisaliser lightbox
    static init() {
        const links = document.querySelectorAll('a[href$="lightbox"], a[href$=".jpg"],a[href$=".jpeg"]')
            //    Parcour chaques images et ajout d'un listener ajout fonction evenemnt
            .forEach(link => link.addEventListener('click', e => {
                // stop evenement par défaut
                e.preventDefault()
                // Initialise nouvelle lightbox
                // Charger lurl et recuperer href
                new lightbox(e.currentTarget.getAttribute('href'))
            }))
    }


    // @param {string} url URL de l'image


    constructor(url) {

        const element = this.buildDom(url)
        document.body.appendChild(element)
    }


    // @param {string} url URL de l'image
    //  @returns {HTMLElement}


    buildDom(url) {
        const dom = document.createElement('div')
        dom.classList.add('lightbox')
        dom.innerHTML = `
            <button class="lightbox__close"></button>
            <div class="lightbox__container">
            <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url(array(500,500)); ?>"/>
            <?php endif; ?>




            <div class ="titrephotolightbox"><?php the_title(); ?></div>
            <div class="anneephotolightbox"> <?php echo $post_date = get_the_date('Y');
            echo $post_date; ?> </div>
        </div>
        `
        return dom
    }

}



lightbox.init()




{/* <div class="lightbox">
  <button class="lightbox__close"></button>

  <div class="lightbox__container">
    <img src="https://picsum.photos/900/1800" alt="">
  </div>
</div> */}