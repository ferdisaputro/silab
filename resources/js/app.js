import './bootstrap';
import 'flowbite';
import { DataTable } from "simple-datatables";
import Swal from 'sweetalert2'

document.addEventListener('livewire:navigated', () => { 
   initFlowbite();
})

window.DataTable = DataTable
window.swal = Swal