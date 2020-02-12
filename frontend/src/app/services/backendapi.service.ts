import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable, from, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { MapAPIResponse } from '../models/mapapiresponse.model';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class BackendAPIService {

  constructor(private http: HttpClient) { }
  
  public getMapAPIResponses(address: string) {
    const body = new HttpParams()
      .set('address', address);
    return this.http.post(environment.backendAPIUrl, body).pipe(
        map((response: any) => response.data.map((item: any) => new MapAPIResponse(
          item.name,
          item.title,
          item.results
        ))), catchError(error => {
          return throwError('Failed to load map coordinates!');
        })
    );
  }
  
}
