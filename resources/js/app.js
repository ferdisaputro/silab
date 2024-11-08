import './bootstrap';
import 'flowbite';
import { DataTable } from "simple-datatables";

document.addEventListener('livewire:navigated', () => { 
   initFlowbite();
})

window.DataTable = DataTable