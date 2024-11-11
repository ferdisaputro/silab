import './bootstrap';
import 'flowbite';
import { DataTable } from "simple-datatables";
import Swal from 'sweetalert2'
import iziToast from 'izitoast';

document.addEventListener('livewire:navigated', () => { 
   initFlowbite();
})

window.DataTable = DataTable
window.swal = Swal
window.iziToast = iziToast
window.iziToast.settings({
   position: 'topRight',
   transitionIn: 'fadeInLeft',
   transitionOut: 'fadeOutRight',
   transitionInMobile: 'fadeInLeft',
   transitionOutMobile: 'fadeOutRight',
})