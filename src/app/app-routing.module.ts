import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

//import components bellow

import { AddBookComponent } from './component/add-book/add-book.component';
import { EditBookComponent } from './component/edit-book/edit-book.component';
import { ListBookComponent } from './component/list-book/list-book.component';


//edit routes
const routes: Routes = [

  {path: '',pathMatch:'full', redirectTo:'AddBookComponent'}, //default route
  {path: 'add-book', component:AddBookComponent},
  {path: 'list-book', component:ListBookComponent},
  {path: 'edit-book/:id', component:EditBookComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
