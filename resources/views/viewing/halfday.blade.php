@extends('layout.layout')

@section('content')
    <div style="margin-bottom: 50px;"></div>
    <div class="container">
        <div class="buttons-container">
            <button  id="print">Print</button>
            <a href="{{ route('hd_index') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">
                Back
            </a>
        </div>
        <a id="save_to_image">
            <div class="invoice-container">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td class="title">
                                        <b>{{$halfday->company_name}}</b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="information">
                        <td colspan="2">
                    <tr>
                        <td>
                            <b>Name :</b>{{$halfday->emp_name}}<br />
                            <b>Email :</b> {{$halfday->email}}<br />

                        </td>
                        <td>
                            <b>Date & Time :</b> {{$halfday->created_at}} <br>
                            <b>Position :</b> {{$halfday->position}}
                        </td>
                    </tr>
                    </td>
                    </tr>
                    <tr class="heading">
                        <td>Halfday/Undertime form</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Date of actual Halfday/Undertime : </b> {{$halfday->actual_hd}}<br />

                        </td>
                        <td>
                             <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b> From : </b>{{$halfday->hd_from}}<br />
                        </td>
                        <td>
                            <b> To : </b> {{$halfday->hd_to}}<br>
                            <br>
                        </td>
                    </tr>
                    <tr class="heading">
                        <td>Reason</td>
                        <td></td>
                    </tr>
                    <tr class="item">
                        <td>{{ $halfday->reason }}</td>
                        <td></td>
                    </tr>
                    <tr class="item last">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="total">
                        <td></td>
                        <td>Signature by</td>
                    </tr>
                </table>
            </div>
        </a>
    </div>
    </div>


    <div style="margin-bottom: 150px;"></div>
@endsection
