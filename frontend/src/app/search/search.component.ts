import { Component, OnInit } from '@angular/core';
import { BackendAPIService } from '../services/backendapi.service';
import { MapAPIResponse } from '../models/mapapiresponse.model';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent implements OnInit {

  address: string = '';
  mapAPIResponses: MapAPIResponse[];

  constructor(private backendAPIService: BackendAPIService) { }

  ngOnInit(): void {
  }
  
  onKeydownEnter(event): void {
    this.mapAPIResponses = [];
    this.backendAPIService
      .getMapAPIResponses(this.address)
      .subscribe(response => {
        this.mapAPIResponses = response;
      });
  }
  
}
