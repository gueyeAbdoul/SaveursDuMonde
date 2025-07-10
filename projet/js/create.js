    let form=document.getElementById('recette-form')
    let recette=document.getElementById('recipe')
    let info=document.getElementById('test')
    let description=document.getElementById('description')
    let label=document.getElementById('label')
    let desc=document.getElementById('desc')
    let insert=document.getElementById('info')
    let btns=document.getElementsByClassName('add-btn');
    let inputAdd=document.getElementsByClassName('add-input');
    let rm_ing_btns=document.getElementsByClassName('rm_ing_btn')
    const list=document.getElementById('list-rec')

    let cmpt=0;
    let tag=0;
    if(recette){
        recette.addEventListener('click',function (evt){
            info.classList.remove('display')
        })
    }
    if(description){
        description.addEventListener('click',function (evt){
            label.classList.remove('display')
            desc.classList.remove('display')
        })
    }

    for(let i=0; i<btns.length; i++){

        btns[i].addEventListener('click',function (evt){

            /*----------------------------Input Ingredient--------------------- */
            let div1=document.createElement('div');
            div1.classList.add('form-input');
            div1.classList.add('update');
            let label=document.createElement('label');
            label.innerText='Titre Ingredient '+(cmpt);
            let label_quant=document.createElement('label');
            label_quant.innerText=' Quantité ';
            let input=document.createElement('input');
            let quantity=document.createElement('input');

            input.type='text';
            input.setAttribute('list','list-rec')
            input.classList.add('verify');
            input.name='ing['+cmpt+']'
            quantity.type='text';
            quantity.name='quantity['+cmpt+']'

            let label_file=document.createElement('label');
            label_file.setAttribute('id','label_file')
            label_file.innerText=' Image Ingredient';
            let file=document.createElement('input');
            file.type='file';
            file.classList.add('rm_file')
            file.name='file-ing['+cmpt+']'
            if(input.name=='ing['+cmpt+']' && btns[i].name=='ing-btn'){
                input.name='ing['+cmpt+']'
                file.name='file-ing['+cmpt+']'
                cmpt++;
            }
            div1.appendChild(label)
            div1.appendChild(input)
            div1.appendChild(label_quant)
            div1.appendChild(quantity)
            div1.appendChild(label_file)
            div1.appendChild(file)

            /*----------------------------Input Tag--------------------- */
            let div2=document.createElement('div');
            div2.classList.add('form-input');
            div2.classList.add('form-input');
            let label2=document.createElement('label');
            label2.innerText='Title Tag '+tag;
            let input2=document.createElement('input');
            input2.type='text';
            input2.name='tag['+tag+']'
            let label_tag=document.createElement('label');
            if(input2.name=='tag['+tag+']' && btns[i].name=='tag-btn'){
                input.name='tag['+tag+']'
                tag++;
            }
            div2.appendChild(label2)
            div2.appendChild(input2)
            div2.appendChild(label_tag)
            let array=[];
            array.push(div1)
            array.push(div2)
            insert.appendChild(array[i]);

            let verify=insert.querySelectorAll('.update .verify')
            let rm=insert.querySelectorAll('.update .rm_file')
            let rm_label=insert.querySelectorAll('.update #label_file')

            for(let i=0; i<verify.length; i++){
                verify[i].addEventListener('keyup',function (evt){
                    let optionTrouvee = false;
                    for (let j = 0; j < list.options.length; j++) {
                        // Comparaison de l'option courante avec la valeur à vérifier
                        if (list.options[j].value === verify[i].value) {
                            optionTrouvee = true;
                            break;
                        }
                    }
                    if (optionTrouvee){
                        rm[i].classList.add('display');
                        rm_label[i].classList.add('display')

                    } else {
                        rm[i].classList.remove('display');
                        rm_label[i].classList.remove('display')
                    }


                    //console.log()
                })
            }

        })
    }





