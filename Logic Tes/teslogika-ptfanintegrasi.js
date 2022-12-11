// * Jawaban soal no 1
var ar1 = [10, 20, 20, 10, 10, 30, 50, 10, 20];
var ar2 = [6,5,2,3,5,2,2,1,1,5,1,3,3,3,5]
var ar3 = [1, 1, 3, 1, 2, 1, 3, 3, 3, 3] 

function jumlahArray(arr){
  let obj=[]
  arr.forEach(i => {
    obj[i]=obj[i] ? obj[i] +1:1; })

  return obj.reduce((acc,ecc)=>{
    acc += Math.floor(ecc/2)
    return acc
  },0)
}

console.log(jumlahArray(ar1))
console.log(jumlahArray(ar2))
console.log(jumlahArray(ar3))



// * Jawaban soal no 2
const kata = "apa yang anda [pikirakn"
const kata2 = "saat mengec*at tembok,Agung dibant_u oleh raihan"
const kata3 = "Berapa u(mur minimal[ untuk !mengurus ktp?"
const kata4 = "Masing-masing anak mendap(atkan uang jajan ya=ng be&rbeda"

console.log(kata2.split(/\b\s/g).length-1)
console.log(kata3.split(/\b\s/g).length-2)
console.log(kata4.split(/\b\s/g).length-3)


  



