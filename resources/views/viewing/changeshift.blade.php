@extends('layout.layout')

@section('content')
    <div style="margin-bottom: 50px;"></div>
    <div class="container">
        <div class="buttons-container">
            <button id="print">Print</button>
            <a href="{{ route('cs_index') }}"
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
                                        <b>{{$changeshift->company_name}} </b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="information">
                        <td colspan="2">
                    <tr>
                        <td>
                            <b>Name : </b>{{$changeshift->emp_name}}<br />
                            <b>Email :</b> {{$changeshift->email}}<br />

                        </td>
                        <td>
                            <b>Date & Time :</b> {{$changeshift->created_at}} <br>
                            <b>Position :</b> {{$changeshift->position}}
                        </td>
                    </tr>
                    </td>
                    </tr>
                    <tr class="heading">
                        <td>Change Shift form</td>
                        <td></td>
                    </tr>
                    <tr>
                        <tr>
                            <td>
                                <b>Date of actual Halfday/Undertime : </b> {{$changeshift->actual_cs}}<br />

                            </td>
                            <td>
                                 <br>
                            </td>
                        </tr>
                        <td>
                            <b> From : </b>{{$changeshift->cs_from}}<br />
                        </td>
                        <td>
                            <b> To : </b> {{$changeshift->cs_to}} <br>
                            <br>
                        </td>
                    </tr>
                    <tr class="heading">
                        <td>Reason</td>
                        <td></td>
                    </tr>
                    <tr class="item">
                        <td>{{$changeshift->reason}}</td>
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
